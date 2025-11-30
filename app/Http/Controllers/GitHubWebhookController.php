<?php

namespace App\Http\Controllers;

use App\Models\RepositoryCommit;
use App\Models\TeamRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GitHubWebhookController extends Controller
{
    public function handleApp(Request $request)
    {
        $secret = config('services.github_app.webhook_secret');

        if (!$secret || !$this->isValidSignature($request, $secret)) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $event = $request->header('X-GitHub-Event');
        if ($event !== 'push') {
            return response()->json(['message' => 'Ignored'], 200);
        }

        $payload = $request->json()->all();
        $repoName = data_get($payload, 'repository.full_name');

        if (!$repoName) {
            return response()->json(['message' => 'Repository not found'], 400);
        }

        $teamRepository = TeamRepository::where('provider', 'github')
            ->where('repo_full_name', strtolower($repoName))
            ->first();

        if (!$teamRepository) {
            return response()->json(['message' => 'Repository not connected'], 404);
        }

        $branchRef = data_get($payload, 'ref', '');
        $branch = $this->extractBranch($branchRef);

        foreach ((array) data_get($payload, 'commits', []) as $commit) {
            $this->storeCommit($teamRepository, $commit, $branch);
        }

        return response()->json(['message' => 'Recorded'], 201);
    }

    public function handle(Request $request, TeamRepository $teamRepository)
    {
        if ($teamRepository->provider !== 'github') {
            return response()->json(['message' => 'Provider mismatch'], 404);
        }

        if (!$this->isValidSignature($request, $teamRepository->webhook_secret)) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $event = $request->header('X-GitHub-Event');
        if ($event !== 'push') {
            return response()->json(['message' => 'Ignored'], 200);
        }

        $payload = $request->json()->all();
        $repoName = data_get($payload, 'repository.full_name');

        if (! $repoName || strtolower($repoName) !== strtolower($teamRepository->repo_full_name)) {
            return response()->json(['message' => 'Repository mismatch'], 404);
        }

        $branchRef = data_get($payload, 'ref', '');
        $branch = $this->extractBranch($branchRef);

        foreach ((array) data_get($payload, 'commits', []) as $commit) {
            $this->storeCommit($teamRepository, $commit, $branch);
        }

        return response()->json(['message' => 'Recorded'], 201);
    }

    private function storeCommit(TeamRepository $teamRepository, array $commit, ?string $branch): void
    {
        $timestamp = data_get($commit, 'timestamp');

        RepositoryCommit::updateOrCreate(
            [
                'team_repository_id' => $teamRepository->id,
                'sha' => $commit['id'] ?? null,
            ],
            [
                'message' => $commit['message'] ?? '',
                'author_name' => data_get($commit, 'author.name'),
                'author_email' => data_get($commit, 'author.email'),
                'branch' => $branch,
                'committed_at' => $timestamp ? Carbon::parse($timestamp) : null,
                'html_url' => $commit['url'] ?? null,
                'payload' => $commit,
            ]
        );
    }

    private function extractBranch(string $ref): ?string
    {
        if (str_starts_with($ref, 'refs/heads/')) {
            return substr($ref, strlen('refs/heads/'));
        }

        return null;
    }

    private function isValidSignature(Request $request, string $secret): bool
    {
        $signature = $request->header('X-Hub-Signature-256');
        if (!$signature || !str_starts_with($signature, 'sha256=')) {
            return false;
        }

        $hash = 'sha256=' . hash_hmac('sha256', $request->getContent(), $secret);

        return hash_equals($hash, $signature);
    }
}
