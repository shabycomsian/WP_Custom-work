Task Instructions:
1. Set Up WordPress Project:
o Install a blank WordPress site on your local development environment.
o Do an initial commit of the blank project to a GitHub repository. Only include the
wp-content/plugins and wp-content/themes directories in the repository.

2. IP Address Redirect:
o Write a function that redirects users away from the site if their IP address starts
with 77.29. Use WordPress native hooks and APIs for this functionality.

3. Custom Post Type and Taxonomy:
o Register a custom post type called &quot;Projects&quot;.
o Register a custom taxonomy called &quot;Project Type&quot; associated with the &quot;Projects&quot;
post type.
4. Archive Page:
o Create a WordPress archive page that displays six &quot;Projects&quot; per page with
simple pagination (next, prev buttons).

5. Ajax Endpoint:
o Create an Ajax endpoint that outputs the last three published &quot;Projects&quot;
belonging to the &quot;Project Type&quot; called &quot;Architecture&quot; if the user is not logged in.
If the user is logged in, return the last six published &quot;Projects&quot; in the
&quot;Architecture&quot; project type.
o The results should be returned in JSON format: {success: true, data: [{id, title, link}, {id,
title, link}, {id, title, link}, ...]}.
6. Random Coffee API Integration:
o Use the WordPress HTTP API to create a function called hs_give_me_coffee() that
returns a direct link to a cup of coffee using the Random Coffee API.

7. Kanye Quotes Page:
o Use the Kanye Rest API to display five quotes on a WordPress page.
