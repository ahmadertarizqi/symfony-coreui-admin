<?php if ($is_modal): ?>
{% extends '@CoreUI/modal_layout.html.twig' %}

{% block title %}
    {{ '<?= strtolower($entity_class_name) ?>'|trans }}
{% endblock %}

{% block body %}
    
    <table class="table table-bordered table-hover">
        <tbody>
            <?php foreach ($entity_fields as $field): ?>
            <tr>
                <th width="30%">{{ '<?= ucfirst($field['fieldName']) ?>'|trans }}</th>
                <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        
{% endblock %} 
    
<?php else: ?>
{% extends "@CoreUI/page_layout.html.twig" %}

{% block page_title %}
    {{ '<?= strtolower($entity_class_name) ?>'|trans }}
{% endblock %}
{% block page_actions %}
    {{ link_to('<?= $route_name ?>_index', {}, { class:"btn btn-sm btn-outline-primary", label: 'back'|trans, icon: '<span class="bi-backspace"></span>' }) }}
{% endblock %}

{% block page %}

    <table class="table table-bordered table-hover">
        <tbody>
            <?php foreach ($entity_fields as $field): ?>
            <tr>
                <th width="30%">{{ '<?= ucfirst($field['fieldName']) ?>'|trans }}</th>
                <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

{% endblock %}
<?php endif ?>