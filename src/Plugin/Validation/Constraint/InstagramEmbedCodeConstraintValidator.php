<?php

/**
 * @file
 * Contains \Drupal\media_entity_instagram\Plugin\Validation\Constraint\InstagramEmbedCodeConstraintValidator.
 */

namespace Drupal\media_entity_instagram\Plugin\Validation\Constraint;

use Drupal\media_entity_instagram\Plugin\MediaEntity\Type\Instagram;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the InstagramEmbedCode constraint.
 */
class InstagramEmbedCodeConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($entity, Constraint $constraint) {
    if (!isset($entity)) {
      return;
    }

    $matches = [];
    foreach (Instagram::$validationRegexp as $pattern => $key) {
      if (preg_match($pattern, $entity->value, $item_matches)) {
        $matches[] = $item_matches;
      }
    }

    if (empty($matches)) {
      $this->context->addViolation($constraint->message);
    }
  }

}
