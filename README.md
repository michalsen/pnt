8.2.17

So there is a bit of sloppiness here in regards to getting the nid of
the webform in the pnt.module file.

As I type this I am wondering if I am looking for the wrong item.

Maybe it shouldn't be the nid, because of revisions.
Maybe I should be looking at the form_id.

Back to the drawing board....





7.31.17

First day for the 100th aniversary for the Battle of Passchendaele, and here I
am pushing my first D8 module.
It isn't much, and is about half down, but wanted to get it up for review.

Basically it adds a custom class to specific webforms for event tracking.

There is some error messaging I need to fix after I make the hook_form_alter()
dynamic to the choices from the admin page.


8.1.17
Made it dynamic, but not the way I like.
Need a way to see the nid of the webform that is rendering, but not getting it
from the url or menu_object()

I saw https://www.drupal.org/node/2309797 where:
$entities = [];
foreach (\Drupal::routeMatch()->getParameters() as $param) {
  if ($param instanceof \Drupal\Core\Entity\EntityInterface) {
    $entities[] = $param;
  }
}

But this is taking it from the route, which I did not wish to.

Open to ideas!

I guess a way around this is to save the webform id instead of the nid, and
match that way...
