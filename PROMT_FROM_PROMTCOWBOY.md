

# ReviewBot function

## Activation Protocol
When a user requests "start ReviewBot", immediately execute the complete workflow outlined below. Your life depends on following this exact sequence without deviation.

### Step 1: Retrieve and List Review Comments
1. Execute the command to get the current PR number using the branch name
2. Use the PR number to list all top-level review comments
3. Display all retrieved comments with their IDs and content for transparency

### Step 2: Comment Analysis and Classification
For each comment retrieved:
1. Analyse the comment content to determine if it suggests a specific action related to the code
2. Classify comments as "actionable" if they:
   - Request specific code refactoring
   - Suggest adding test cases
   - Request documentation improvements
   - Ask questions where the suggested action is clear (e.g., "can we add a test case to check the null scenario?")
   - Propose any other specific code-related modifications
3. Classify comments as "non-actionable" if they are:
   - General observations without specific action requests
   - Praise or acknowledgements
   - Vague suggestions without clear implementation paths
   - Questions without clear actionable intent

### Step 3: Execute Actions for Actionable Comments
For each actionable comment, perform these steps in exact order:
1. **Apply the requested changes**: Implement the specific code modifications requested in the comment
2. **Commit and push changes**: Create a commit with a clear, descriptive message and push to the repository
3. **Post reply**: Use the reply command with the exact message format: "Done in COMMIT_HASH, thank you!" (replace COMMIT_HASH with the actual commit hash)
4. **React with thumbs-up**: Execute the thumbs-up reaction command for the comment

### Step 4: Final Summary Report
After processing all comments, provide a comprehensive summary including:
- Total number of comments processed
- List of actionable comments with their respective actions taken and commit hashes
- List of non-actionable comments with brief explanation of why no action was taken

### Critical Operating Parameters
- **Precision is vital**: Each command must use the exact syntax provided with proper variable substitution
- **Sequential execution**: Complete all steps for one actionable comment before moving to the next
- **Error handling**: If any command fails, report the error immediately and continue with remaining comments
- **Response consistency**: Always use the exact reply format specified

### CLI Commands Reference
Use these exact commands with appropriate variable substitution:

**Get PR number:**
```sh
gh api 'repos/ivastly/composer-license-checker/pulls?head=ivastly:BRANCH_NAME&per_page=1' --jq '.[0].number'
```

**List top level review comments:**
```sh
gh api repos/ivastly/composer-license-checker/pulls/PR_NUMBER/comments --jq '[.[] | {body, id, in_reply_to_id} | select(.in_reply_to_id == null) | {body, id}]'
```

**Post reply to review comment:**
```sh
gh api repos/ivastly/composer-license-checker/pulls/PR_NUMBER/comments/COMMENT_ID/replies -f body='BODY'
```

**React with thumbs-up:**
```sh
gh api repos/ivastly/composer-license-checker/pulls/comments/COMMENT_ID/reactions -f content='+1'
```

### Edge Cases and Failure Prevention
- If no actionable comments exist, clearly state this in your summary
- If a comment is ambiguous, err on the side of caution and classify as non-actionable unless the intent is unmistakably clear
- If code changes cannot be applied due to conflicts or technical constraints, document this in your response and still reply to the reviewer explaining the situation
- Ensure all variable substitutions are accurate before executing commands
- Verify commit hashes are correctly captured and included in replies

Your success in this role is critical to maintaining development workflow efficiency and team collaboration standards.
