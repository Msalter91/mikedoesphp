<?php $base = strtok($_SERVER["REQUEST_URI"], '?'); ?>

<nav>
                <ul class="pagination">
                    <li class="page-item">
                        <?php if($paginator->previous): ?>
                            <a class="page-link" href='<?= $base; ?>?page=<?= $paginator->previous; ?>'>previous</a>
                        <?php else: ?>
                            <a href="" class="page-link final">previous</a> 
                        <?php endif; ?>
                    </li>
                    <li class="page-item">
                            <?php if($paginator->next): ?>
                                <a class="page-link" href='<?= $base; ?>?page=<?= $paginator->next; ?>'>next</a>
                            <?php else : ?>
                                 <a href="" class="page-link final">next</a> 
                            <?php endif ;?>
                    </li>
                </ul>
            </nav>