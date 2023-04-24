# Views Count Endpoint

This WordPress plugin provides a REST API endpoint that returns the number of views of a post. It also provides an endpoint to increment the views count of a post.

## Installation

Download the zip in realese.
Add and Activate the plugin through the 'Plugins' menu in WordPress.

## Usage 

**GET /wp-json/views-count/v1/{slug}** <br>

Retrieves the number of views for the post with the specified slug. <br>

Example:

```
  GET /wp-json/views-count/v1/my-post
```
Response: 
```
200 OK
{
  "views_count": 42
}
```

**POST /wp-json/increment-views/v1/{slug}** <br>
Increments the views count for the post with the specified slug. <br>

Example:

```
POST /wp-json/increment-views/v1/my-post
```
Response:
```
200 OK
{
  "views_count": 43
}
```

## Notes
This plugin uses the get_post_meta() and update_post_meta() functions to store and retrieve the views count. Therefore, it should work with any post type that supports custom fields.
The slug parameter should match the post slug, not the post ID.
This plugin uses the WordPress REST API, which requires authentication by default. Therefore, these endpoints are protected and can only be accessed by authenticated users. If you need to allow anonymous access to these endpoints, you should use a plugin like JWT Authentication for WP REST API to add token-based authentication.