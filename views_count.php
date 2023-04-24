<?php

/**
 * Plugin Name: Views Count Endpoint
 */

function get_views_count($request)
{
  $post_slug = $request->get_param('slug');
  // $post_id = get_page_by_path($post_slug)->ID;
  $post = get_page_by_path('/' . $post_slug, OBJECT, 'post');
  $post_id = $post ? $post->ID : null;
  $views_count = get_post_meta($post_id, 'views_count', true);
  if (empty($views_count)) {
    $views_count = 0;
  }
  return $views_count;
}

add_action('rest_api_init', function () {
  register_rest_route('views-count/v1', '/(?P<slug>[a-z0-9-]+)', array(
    'methods' => 'GET',
    'callback' => 'get_views_count',
  ));
});

function my_increment_views_count($request)
{
  $post_slug = $request->get_param('slug');
  // $post_id = get_page_by_path($post_slug)->ID;
  $post = get_page_by_path('/' . $post_slug, OBJECT, 'post');
  $post_id = $post ? $post->ID : null;
  $views_count = get_post_meta($post_id, 'views_count', true);
  if (empty($views_count)) {
    $views_count = 0;
  }
  $views_count++;
  update_post_meta($post_id, 'views_count', $views_count);
  return $views_count;
}

add_action('rest_api_init', function () {
  register_rest_route('increment-views/v1', '/(?P<slug>[a-z0-9-]+)', array(
    'methods' => 'POST',
    'callback' => 'my_increment_views_count',
  ));
});

function set_views_count($request)
{
  $post_slug = $request->get_param('slug');
  $post = get_page_by_path('/' . $post_slug, OBJECT, 'post');
  $post_id = $post ? $post->ID : null;
  $views_count = $request->get_param('count');
  if (empty($views_count)) {
    return new WP_Error('empty_count_param', 'Count parameter is required', array('status' => 400));
  }
  update_post_meta($post_id, 'views_count', $views_count);
  return $views_count;
}

add_action('rest_api_init', function () {
  register_rest_route('set-views-count/v1', '/(?P<slug>[a-z0-9-]+)', array(
    'methods' => 'POST',
    'callback' => 'set_views_count',
  ));
});