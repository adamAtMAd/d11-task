<?php

declare(strict_types=1);

namespace Drupal\custom_article_tools\EventSubscriber;

use Drupal\core_event_dispatcher\EntityHookEvents;
use Drupal\core_event_dispatcher\Event\Entity\EntityInsertEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Subscribe to node create event.
 */
final class CustomArticleToolsSubscriber implements EventSubscriberInterface {
  /**
   * Entity insert.
   *
   * @param \Drupal\core_event_dispatcher\Event\Entity\EntityInsertEvent $event
   *   The event.
   */
  public function entityInsert(EntityInsertEvent $event): void {
    $entity = $event->getEntity();

    if ($entity->bundle() !== 'article') {
      return;
    }

    \Drupal::logger('custom_article_tools')
      ->info(sprintf('New article with id: "%s" and title: "%s" created', $entity->id(), $entity->label()));
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      EntityHookEvents::ENTITY_INSERT => 'entityInsert',
    ];
  }

}
