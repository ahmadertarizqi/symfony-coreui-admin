{% extends "@CoreUI/page_layout.html.twig" %}

{% block page_title %}
    {{ '<?= strtolower($entity_class_name) ?>'|trans }}
{% endblock %}
{% block page_actions %}
    <?php if ($is_modal): ?>
    {{ link_to('<?= $route_name ?>_create', {}, { class:"btn btn-sm btn-outline-success", label: 'create'|trans, "data-toggle": "modal", "data-target":"#modal", icon: '<span class="bi-plus"></span>', }) }}
    <?php else: ?>
    {{ link_to('<?= $route_name ?>_create', {}, { class:"btn btn-sm btn-outline-success", label: 'create'|trans, icon: '<span class="bi-plus"></span>', }) }}
    <?php endif ?>
{% endblock %}

{% block page %}
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
            <?php foreach ($entity_fields as $k => $field): ?>
                <?php if (in_array($k, $fields_skip)):?>
                    <?php continue; ?>
                <?php endif ?>
                <th>{{ '<?= strtolower($field['fieldName']) ?>'|trans }}</th>
            <?php endforeach; ?>
                <th>{{ 'actions'|trans }}</th>
            </tr>
        </thead>
        <tbody>

            <?php if ($use_filter):?>
            {{ include('<?= $templates_path ?>/_filters.html.twig', {<?= $filter_name ?>: <?= $filter_name ?>}) }} 
            <?php endif ?>
        {% for <?= $entity_twig_var_singular ?> in <?= $entity_twig_var_plural ?> %}
            <tr>
            <?php $count = 0 ?>
            <?php foreach ($entity_fields as $k => $field): ?>
                <?php if (in_array($k, $fields_skip)):?>
                    <?php continue; ?>
                <?php endif ?>
                <?php $count++ ?>
                <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
            <?php endforeach; ?>
                <td>
                    <?php if ($is_modal): ?>
                    {{ link_to('<?= $route_name ?>_show', { <?= $entity_identifier ?>: <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?> }, { class:"btn btn-xs btn-outline-primary", "data-toggle": "modal", "data-target":"#modal", label: 'show'|trans, icon: '<span class="bi-display"></span>' }) }}
                    {{ link_to('<?= $route_name ?>_edit', { <?= $entity_identifier ?>: <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?> }, { class:"btn btn-xs btn-outline-info", "data-toggle": "modal", "data-target":"#modal", label: 'edit'|trans, icon: '<span class="bi-pencil-square"></span>' }) }}
                    <?php else:?>
                    {{ link_to('<?= $route_name ?>_show', { <?= $entity_identifier ?>: <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?> }, { class:"btn btn-xs btn-outline-primary", label: 'show'|trans, icon: '<span class="bi-display"></span>' }) }}
                    {{ link_to('<?= $route_name ?>_edit', { <?= $entity_identifier ?>: <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?> }, { class:"btn btn-xs btn-outline-info", label: 'edit'|trans, icon: '<span class="bi-pencil-square"></span>' }) }}
                    <?php endif?>
                    {{ delete_tag('delete' ~ <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>, '<?= $route_name ?>_delete', { <?= $entity_identifier ?>: <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?> }, { class: "btn btn-xs btn-outline-danger", 'icon': '<span class="bi-trash"></span>', label: 'delete'|trans }) }}
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan="<?= $count ?>">{{ 'no_records_found'|trans }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>

{% endblock %}

{% block page_footer_left %}
    <div class="col-lg-2">
        {{ include('<?= $templates_path ?>/_max_per_page.html.twig', {url: '<?= $route_name ?>_index'}) }}
    </div>
{% endblock %}
{% block pagination %}
        <ul class="pagination justify-content-end">
            {{ knp_pagination_render(<?= $entity_twig_var_plural ?>) }}
        </ul>
{% endblock %}
