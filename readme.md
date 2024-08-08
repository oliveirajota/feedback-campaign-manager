# Feedback Campaign Manager

A comprehensive tool for managing feedback campaigns among coworkers, allowing for the collection of anonymous feedback, setting deadlines, and generating insightful reports on individual and overall performance.

## Features

- **Create Feedback Campaigns**: Easily set up feedback campaigns tailored to your team's needs.
- **Set Deadlines**: Define deadlines for answering the surveys to ensure timely feedback.
- **Individual and Overall Feedback Scores**: View individual feedback as well as aggregate scores to understand overall team performance.
- **Anonymous Answers**: Ensure honest and constructive feedback with anonymous responses.

## Getting Started

### Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 7.4
- Composer
- MySQL or any other supported database
- Web server (e.g., Apache, Nginx)
- Laravel Framework

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/feedback-campaign-manager.git
    cd feedback-campaign-manager
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Copy the `.env` file and configure your environment variables:

    ```bash
    cp .env.example .env
    ```

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

5. Run database migrations:

    ```bash
    php artisan migrate
    ```

6. (Optional) Seed the database with sample data:

    ```bash
    php artisan db:seed
    ```

7. Start the development server:

    ```bash
    php artisan serve
    ```

### Usage

- **Creating a Campaign**: Navigate to the "Campaigns" section and click "Create New Campaign". Fill in the necessary details and set a deadline.
- **Responding to a Survey**: Participants will receive a link to respond anonymously before the deadline.
- **Viewing Results**: Once the deadline has passed, view individual and overall scores in the "Results" section.

### Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### License

Distributed under the MIT License. See `LICENSE` for more information.

