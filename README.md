# Hey Professor
  
*develop*: [![CI Develop](https://github.com/mmonari/hey-professor/actions/workflows/laravel.yml/badge.svg?branch=develop)](https://github.com/mmonari/hey-professor/actions/workflows/laravel.yml)
*main* [![CI Main](https://github.com/mmonari/hey-professor/actions/workflows/laravel.yml/badge.svg?branch=main)](https://github.com/mmonari/hey-professor/actions/workflows/laravel.yml)

**Hey Professor** is a proof-of-concept (POC) application developed as part of the Laravel course from **Pinguim Academy**. This project showcases a simple Q&A platform where students can submit questions for their professor, with a voting system that prioritizes questions by popularity. The highest-voted questions get answered first, promoting transparency and interactivity in the classroom.

## Features

- **User Authentication with GitHub OAuth**: Allows students to log in securely using their GitHub accounts.
- **Question Management**:
  - **Draft, Publish, Archive**: Students can draft questions, publish them when ready, and archive old or irrelevant ones.
  - **Voting System**: Students vote on questions of interest, with the highest-voted questions prioritized for responses.
- **Frontend**: Built with the Blade templating engine for a responsive, user-friendly experience.
- **Database**: SQLite, ideal for a lightweight, low-overhead development environment.

## Technical Overview

- **Framework**: Laravel 11
- **Frontend**: Blade templating engine
- **OAuth Integration**: GitHub OAuth for secure login
- **Database**: SQLite for lightweight data storage
- **Testing**: TDD with [PEST](https://pestphp.com/) for streamlined, readable test cases
- **Code Quality**:
  - **phpStan** for code analysis
  - **PINT** for code linting
- **Development Workflow**:
  - Follows Gitflow, with feature-based branching, pre-commit checks, and commit message hooks.
  - Continuous Integration with automated testing and linting.
  - Managed with GitHub Projects to organize sprints and track issue integration.

## Getting Started

### Prerequisites

- PHP 8.x
- Composer
- Node.js (for frontend asset compilation)
- GitHub account for OAuth login

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/mmonari/hey-professor.git
   cd hey-professor
   ```

2. Install dependencies:

   ```bash
   composer install
   npm install && npm run build
   ```

3. Set up environment variables:

   - Copy `.env.example` to `.env`.
   - Set your GitHub OAuth credentials (`GITHUB_CLIENT_ID` and `GITHUB_CLIENT_SECRET`).
   - Set the `DB_CONNECTION` to `sqlite` and specify the database path.

   ```bash
   php artisan key:generate
   ```

4. Run migrations and populate with sample data (seeding is optional):

   ```bash
   php artisan migrate:fresh --seed
   ```

5. Serve the application:

   ```bash
   php artisan serve
   ```

### Testing

This application is fully tested with TDD principles. To run tests:

```bash
php artisan test
```

## Project Management and Workflow

This project follows a structured Gitflow methodology:

- **Branching**: Each feature is developed on its own branch.
- **Pre-commit Checks**: Ensures code quality and linting consistency.
- **Commit Hooks**: Enforces structured commit messages based on feature branch names.

Issues and sprints are organized in **GitHub Projects**, allowing structured, agile development and easy tracking of ongoing tasks.

## Contributing

Contributions are welcome! Please fork the repository, create a feature branch, and submit a pull request with a detailed explanation of your changes.

---