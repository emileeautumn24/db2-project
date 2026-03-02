## Git Workflow

This repository requires developers to use [Git][7] as a version control tool and [GitHub][8] as a remote repository platform.

This document defines how Git is used in this project. It covers branch naming, making commits, synchronizing with the remote repository, opening pull requests, and handling common edge cases such as merge conflicts and accidental commits. All contributors should comply with all the rules of the workflow in this documentation.

Check [this document](docs/tech-stack/git-and-github.md) for more information about Git hooks and GitHub workflow.

### Basic

This repository has a default branch named `main`. The remote repository is referenced as `origin` (GitHub). If your local repository uses a different remote name, adjust commands accordingly. You can confirm your remotes from the project root using:

```bash
git remote -v
```

### Branching Model

Because our team is small, and this project is a web application that requires frequent deployments, we use the [GitHub flow][1] branching model for this project.

The main branch is named `main` and always contains deployable, stable code. When this project is deployed on a serverless platform, the platform automatically builds and restarts the application whenever the `main` branch is updated [[2]]. Developers create feature branches from `main` to work on new features, bug fixes, and documentation updates. Then, they merge them back to the `main` branch, resolving any conflicts before finalizing the merge.

The naming convention for branches is as follows:

```text
<type>/<short-description>
```

Here, `<type>` indicates the type of work being done and can be one of the following [[3]]:

- `chore`: Add, update, delete, and dependencies and project configuration files.
- `feat`: Add new features to the application.
- `fix`: Fix a specific bug.
- `improve`: Improve performance, comments, names that are unrelated to core features.
- `refactor`: Change the code organization, directory structure, and others that are related to project structure.
- `docs`: Add, update, and delete documents.
- `test`: Add, update, and delete test suites and cases.

The short description should be a concise summary of the changes being made in the branch, using hyphens (`-`) to separate words. For example, a branch for adding user authentication might be named `feat/user-authentication`.

### Commits

Each commit should contain only one specific change or fix. Developers should avoid combining unrelated changes into a single commit. Commit messages must be clear and concise, and should follow this format:

```text
<type>[(<scope>)]: <short-summary>
```

Here, `<type>` corresponds to the branch type, (`<scope>`) is the related scope (optional, usually a few words that help other developers quickly understand the context), and `<short-summary>` (also known as a _subject_) is a brief description of the change, written in the imperative mood. For example:

```text
chore: update Next.js to version 16.1
fix: resolve crash on app startup
feat(auth): add user login functionality
```

Commit descriptions should be written in complete, human-readable sentences, with as few bullet points as possible.

Do not commit credential files (e.g., `.env` files), build artifacts (e.g., files in `build` or `.next` directories), or IDE configuration files (e.g., `.vscode`, `.idea` directories). Check the `.gitignore` file for more details.

### Merging and Rebasing

While working, developers should frequently pull changes from the `main` branch to reduce the chance of a large conflict later (this can be done using various tools). This project prefers rebasing feature branches onto the `main` branch before opening or updating a pull request. You can do it using the following commands:

```bash
# In your feature (or other) branch
git fetch origin
git rebase origin/main
```

### Opening a Pull Request

Before opening a pull request on GitHub, ensure that your feature branch is up-to-date with the `main` branch as described above, run the project's test and linters (which will be automated by [Husky][6]), and review your diff locally to ensure you are not submitting unintended changes. Use the following command to review what you are about to submit:

```bash
git diff origin/main...HEAD
```

Pull request descriptions must explain what changed and why it changed in plain language.

### Versioning and Tagging

This project uses a hybrid of **calendar versioning (CalVer)** and **semantic versioning** for versioning and tagging releases [4] [5]. The version format is `YEAR.MINOR.PATCH`, where `YEAR` is the current year, `MINOR` is incremented for new features, and `PATCH` is incremented for bug fixes and minor changes. `MINOR` starts at `1`. It is assumed that a new major version will be released every single year. `.PATCH` is omitted for an initial minor release. The following are valid version examples:

```text
2026.1      # The first version released in the year 2026
2026.1.1    # Indicate the first patch for version 2026.1
2027.3.11   # Indicate the eleventh patch for version 2027.3
```

During development, developers can create `2026.0.x` versions to mark milestones throughout the process. Managers should understand that these versions are not ready for use, as some features may still be unfinished.

We use Git tags to mark release points in the repository. Tags should follow the versioning format mentioned above. To create a new tag, use the following command:

```bash
git tag -a <version> -m "Complete release message."
```

The comment must be a complete release message in one sentence. Use the following command to view all tags/versions:

```bash
git for-each-ref refs/tags --format='%(if)%(taggerdate)%(then)%(refname:short)%(end)'
```

[1]: https://git-scm.com/book/en/v2/Git-Branching-Branches-in-a-Nutshell
[2]: https://www.geeksforgeeks.org/git/branching-strategies-in-git/
[3]: https://confluence.atlassian.com/bitbucketserver081/branches-1141482379.html
[4]: https://calver.org
[5]: https://semver.org
[6]: https://github.com/typicode/husky
[7]: https://git-scm.com/about
[8]: https://docs.github.com/en/get-started
