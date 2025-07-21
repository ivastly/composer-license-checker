#!/bin/bash
# current branch
git rev-parse --abbrev-ref HEAD

# get PR number
gh api 'repos/ivastly/composer-license-checker/pulls?head=ivastly:feature-branch&per_page=1' --jq '.[0].number'

# list top level review comments by others
 gh api repos/ivastly/composer-license-checker/pulls/1/comments --jq '[.[] | {body, id, in_reply_to_id,author_association} | select((.in_reply_to_id == null) and (.author_association != "OWNER")) | {body, id}]'

# list top level review comments by everyone, including owner (for Hackathon)
 gh api repos/ivastly/composer-license-checker/pulls/1/comments --jq '[.[] | {body, id, in_reply_to_id} | select(.in_reply_to_id == null) | {body, id}]'

# post a review comment reply
# comments/{id} is the `id` field from the list review comments response
gh api repos/ivastly/composer-license-checker/pulls/1/comments/2216391314/replies -f body='Addressed your comment😊'

# react with an thumbs-up
gh api repos/ivastly/composer-license-checker/pulls/comments/2216391314/reactions -f content='+1'
