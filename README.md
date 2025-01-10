Social Media Platform Project
Tech Stack: Laravel, Inertia.js, Vue.js, MySQL

I developed a comprehensive social media platform using Laravel Sail, Inertia.js, and Vue.js, providing a wide range of powerful features for both individual users and groups. The platform allows users to create and manage personal profiles, post and interact with posts, join groups, and manage group members. Key features include:

1. User Profile Management:
Registration and Email Verification: Users can register with email verification, ensuring security and authentication.
Create and Update Profile: Users can create personal profiles, update details such as name, avatar, cover image, and personal information.
Follow Management: The platform supports follow/unfollow functionality, allowing users to follow or unfollow others. Email notifications are sent when users follow or unfollow others.
Personal Profile Tabs: Each user has a profile page with tabs displaying their posts, followers, following users, and uploaded photos.

2. Post Features and Interaction:
Create, Edit, and Delete Posts: Users can create new posts, edit existing posts, and delete their own posts. Posts can include attachments (images, videos), and the system validates uploaded files.
Like and Comment: Users can like/unlike posts and comment on them. Comments can be nested, and users can edit or delete their own comments. Post owners can also delete others' comments.
Notifications: Email notifications are sent when a post is deleted by the group admin or the post owner.

3. Group Management and Access Control:
Create and Manage Groups: Users can create groups with unique names, upload group avatars and cover images. Groups have dedicated pages with tabs for posts, members, join requests, and group information.
Member Management: Group admins can invite members via username or email, and users receive email notifications with a link to join the group.
Join Requests and Member Roles: Groups can have automatic or manual approval for joining. Users can request to join a group, and admins are notified to approve or reject the request. Admins can also change member roles (admin or regular member), triggering email notifications.
Manage Group Posts: Group admins can delete posts from the group, and email notifications are sent to the post owner when this occurs.

4. Advanced Features:
URL Insertion and Preview: When a user inserts a URL into a post, the system automatically generates a preview of the link, enhancing user experience.
AI URL Preview: The project integrates AI functionality to automatically generate previews for URLs inserted into posts.
This project not only provides core social media features but also offers advanced management tools for users and admins to effectively manage content and interactions, ensuring both security and a seamless user experience.

## Installation with Docker

### 1. Clone the project

### 2. Run `composer install`
Navigate into the project folder using Terminal and execute the following command:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### 3. Copy `.env.example` to `.env`

```bash
cp .env.example .env
```

### 4. Start the project in detached mode

```bash
./vendor/bin/sail up -d
```

From now on, whenever you want to run artisan commands, you should execute them from within the container. To access the Docker container:
```bash
./vendor/bin/sail bash
```

### 5. Set the encryption key

```bash
php artisan key:generate --ansi
```

### 6. Run migrations

```bash
php artisan migrate
