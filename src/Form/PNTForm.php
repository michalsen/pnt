<?php
/**
  * @file
  * Contains \Drupal\pnt\Form\PNTForm
  */

namespace Drupal\pnt\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;


/**
  *  Provides PNT Email form
  */
class PNTForm extends FormBase {

  public function getFormId() {
    return 'PNT_email_form';
  }

  /**
    * (@inheritdoc)
    */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $query = \Drupal::entityQuery('node', 'n')
               ->condition('type', 'webform','LIKE');

    $nodes = entity_load_multiple('node', $query->execute());

    foreach ($nodes as $nid => $value) {
      $node = Node::load($nid);
      $checkboxes[$node->id()] = $node->title->value;
    }

    $set_pnt = \Drupal::state()->get('pnt_webforms');
    $pnt_webforms = json_decode($set_pnt);

    $checked = array_intersect($checkboxes, $pnt_webforms);

    foreach ($checkboxes as $key => $value) {
      if (in_array($key, $pnt_webforms)) {
        $checked[] = $key;
      }
    }

    $form['pnt_class'] = array(
      '#title' => t('Webforms on Site'),
      '#type' => 'checkboxes',
      '#options' => $checkboxes,
      '#default_value' => $checked,
      '#description' => t('Add PNT class.'),
      '#required' => FALSE
    );
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit')
      );

    return $form;

  }

  /**
    * (@inheritdoc)
    */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $nids = $form_state->getValue('pnt_class');
    foreach ($nids as $key => $value) {
      if ($value > 0) {
        $webforms[] = $value;
      }
    }
    \Drupal::state()->set('pnt_webforms', json_encode($webforms));
  }

}
