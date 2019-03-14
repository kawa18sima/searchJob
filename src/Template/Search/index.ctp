<?= $this->Html->css('search.css') ?>
<?= $this->Form->create(false, ['url' => 'search/index', 'type' => 'get']) ?>
<h2>仕事 フリーワード検索</h2>
<div class="input_box">
    <?= $this->Form->control('find',['label' => '', 'type' => 'text']); ?>
    <?= $this->Form->button('検索', ['class' => 'submit']) ?>
</div>

<?= $this->Form->end() ?>
<?php if(gettype($jobs) == "object"): ?>
<ul>
    <li>
    <?php if(isset($jobs->numFound)): ?>
        <h3><?= $jobs->numFound ?>件ヒット</h3>
    <?php endif ?>
    </li>
    <?php foreach($jobs->docs as $job): ?>
        <li class="job">
            <h2><?= $this->Html->link($job->company[0], $job->link)?></h2>
            <h4><?= $job->subtitle ?></h4>
            <p><?= $job->explanation ?></p>
            <table>
                <tr>
                    <th>雇用形態</th>
                    <td><?= $job->employmentStatus ?></td>
                </tr>
                <tr>
                    <th>アクセス</th>
                    <td><?= $job->access ?></td>
                </tr>
                <tr>
                    <th>時間帯</th>
                    <td><?= $job->time ?></td>
                </tr>
                <tr>
                    <th>給与</th>
                    <td><?= $job->salaly ?></td>
                </tr>
            </table>
        </li>
    <?php endforeach ?>
</ul>
<?php endif ?>