<?php

namespace Drupal\contact_message_permissions;

use Drupal\Core\Routing\UrlGeneratorTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\contact\Entity\ContactForm;

/**
 * Defines dynamic permissions.
 *
 * @ingroup contact_message_permissions
 */
class PermissionsGenerator {
  use StringTranslationTrait;
  use UrlGeneratorTrait;

  /**
   * Returns an array of entity type permissions.
   *
   * @return array
   *   The permissions.
   */
  public function entityPermissions() {
    $perms = [];
    // Generate entity permissions for all entity types.
    foreach (ContactForm::loadMultiple() as $form) {
      $perms = array_merge($perms, $this->buildPermissions($form));
    }

    return $perms;
  }

  /**
   * Builds a list of entity permissions for a given type.
   *
   * @param ContactForm $form
   *   The entity type.
   *
   * @return array
   *   An array of permissions.
   */
  private function buildPermissions(ContactForm $form) {
    return [
      'access messages for ' . $form->id() => [
        'title' => $this->t('Access messages created with %form form', ['%form' => $form->label()]),
      ],
    ];
  }
}
