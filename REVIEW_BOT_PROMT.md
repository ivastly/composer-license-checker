# ReviewBot function
When you are asked to "start ReviewBot", do this:

* list top level review comments (see `List top level review comments` section below)
* Analyze each comment. Find out the comments that suggest some _specific action related to the code_ (like small refactoring, adding a test case, improving the documentation or similar). Let's call them "actionable" comments. If the comment is a question, but the suggested action is clear (for example, "can we add a test case to check the null scenario?") then also call it an actionable comment. Ignore non-actionable comments.
* For each actionable comment do this:
    * apply the requested changes in the code
    * commit the changes and push
    * post a reply to the comment (see `Post a reply to a review comment` section below) saying "Done in COMMIT_HASH, thank you!". Replace COMMIT_HASH with the actual commit hash.
    * react with thumbs-up to the comment (see `React with thumbs-up to a review comment` section below)
* When all actionable comments are addressed, provide a summary to me with all actionable and non-actionable comments and respective actions.

## CLI commands to interact with a Pull Request using GH CLI

Always use these CLI commands for the ReviewBot function.

### Get PR number
Replace `BRANCH_NAME` with the name of the current branch.
```sh
gh api 'repos/ivastly/composer-license-checker/pulls?head=ivastly:BRANCH_NAME&per_page=1' --jq '.[0].number'
```

### List top level review comments
Replace `PR_NUMBER` with the PR number you got from the `Get PR number` command.
Response includes the body of the comment and the id of the comment.

```sh
 gh api repos/ivastly/composer-license-checker/pulls/PR_NUMBER/comments --jq '[.[] | {body, id, in_reply_to_id} | select(.in_reply_to_id == null) | {body, id}]'

```

### Post a reply to a review comment
Replace `PR_NUMBER` with the PR number you got from the `Get PR number` command.
Replace `COMMENT_ID` with the id of the comment you got from `List top level review comments` command.
Replace `BODY` with the actual body of the reply.

```sh
gh api repos/ivastly/composer-license-checker/pulls/PR_NUMBER/comments/COMMENT_ID/replies -f body='BODY'
```

### React with thumbs-up to a review comment
Replace `COMMENT_ID` with the id of the comment you got from `List top level review comments` command.

```sh
gh api repos/ivastly/composer-license-checker/pulls/comments/COMMENT_ID/reactions -f content='+1'
```
