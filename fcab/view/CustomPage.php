<?php


namespace fcab\view;


use WP_Post;

abstract class CustomPage implements Page
{
    protected string $url;
    protected string $title;
    protected ?string $content = null;
    protected string $template;
    protected ?WP_Post $wp_post = null;

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle($title): Page
    {
        $this->title = $title;
        return $this;
    }

    public function setContent($content): Page
    {
        $this->content = $content;
        return $this;
    }

    public function setTemplate($template): Page
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function asWpPost(): WP_Post
    {
        if (is_null($this->wp_post)) {
            $post = array(
                'ID' => 0,
                'post_title' => $this->title,
                'post_name' => sanitize_title($this->title),
                'post_content' => $this->content ?: '',
                'post_excerpt' => '',
                'post_parent' => 0,
                'menu_order' => 0,
                'post_type' => 'page',
                'post_status' => 'publish',
                'comment_status' => 'closed',
                'ping_status' => 'closed',
                'comment_count' => 0,
                'post_password' => '',
                'to_ping' => '',
                'pinged' => '',
                'guid' => home_url($this->getUrl()),
                'post_date' => current_time('mysql'),
                'post_date_gmt' => current_time('mysql', 1),
                'post_author' => is_user_logged_in() ? get_current_user_id() : 0,
                'is_virtual' => TRUE,
                'filter' => 'raw'
            );
            $this->wp_post = new WP_Post((object)$post);
        }
        return $this->wp_post;
    }
}
