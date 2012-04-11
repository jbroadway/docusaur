# Docusaur

**STATUS: PRE-ALPHA**

API documentation browser for software projects, made to work like the php.net
website. Pages are created manually instead of being auto-generated, providing
for more information than dockblocks can provide on their own.

Usage:

1. Install on an Elefant website
2. Set the error_handler to docusaur/index
3. Add `sitemap/generate[] = docusaur/sitemap` to hooks
4. Edit apps/docusaur/conf/config.php to configure
5. Create a layout with a sidebar containing {! docusaur/nav !}
6. Go to Tools > Docusaur and add your content

Supports [Disqus](http://disqus.com/) for comments, and searching via URLs,
e.g., `/I18n::get` would forward to `/1.2/I18n/get` where `1.2` is the
default version.
