# Kitty-sProject
## プロジェクト演習2
# mainブランチにpull request
完成形をmasterブランチとする
開発段階ではmainブランチにmergeする。

               
- master
  - main
    - feature/yoshi
    - feature/imai
    - feature/tauchi
    - feature/tani
    - feature/kobayashi

ブランチの一覧確認
> git branch -a
```
  master
* main
  feature/名前
  remotes/origin/HEAD -> origin/master
  remotes/origin/master
  remotes/origin/feature/名前
```
ローカルブランチの削除
> git branch -d ブランチ名

ローカルブランチ名の変更
> git branch -m ブランチ名

mergeされている場合
> git branch -D ブランチ名

リモートブランチの削除
> git push origin :ブランチ名

ローカルブランチをプッシュ
> git push origin ブランチ名


