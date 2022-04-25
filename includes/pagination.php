<?php $base = strtok($_SERVER["REQUEST_URI"], '?'); ?>

<nav>
                <ul>
                    <li>
                        <?php if($paginator->previous): ?>
                            <a href='<?= $base; ?>?page=<?= $paginator->previous; ?>'>previous</a>
                        <?php else: ?>
                            previous
                        <?php endif; ?>
                    </li>
                    <li>
                            <?php if($paginator->next): ?>
                                <a href='<?= $base; ?>?page=<?= $paginator->next; ?>'>next</a>
                            <?php else : ?>
                                next
                            <?php endif ;?>
                    </li>
                </ul>
            </nav>