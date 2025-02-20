@extends('backend.layouts.app')

@section('title', __('backend_permissions.labels.management') . ' | ' . __('backend_permissions.labels.edit'))

@section('breadcrumb-links')
@include('backend.permission.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($permission, 'PATCH', route('admin.permissions.update', $permission->id))->class('form-horizontal')->open() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('backend_permissions.labels.management')
                    <small class="text-muted">@lang('backend_permissions.labels.edit')</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                {{ html()->hidden('description')->id('description_field') }}
                {{ html()->hidden('name')->id('name_field') }}
                <!-- Dropdown (Not Submitted) -->
                <div class="form-group row">
                    {{ html()->label('Action')->class('col-md-2 form-control-label')->for('action') }}

                    <div class="col-md-10">
                        {{ html()->select()->id('action_field')->class('form-control')->options([
                            'manage' => 'Manage',
                            'store' => 'Store',
                            'update' => 'Update'
                        ])->required() }}
                    </div><!--col-->
                </div><!--form-group-->

                <!-- Model Text Field (Not Submitted) -->
                <div class="form-group row">
                    {{ html()->label('Model')->class('col-md-2 form-control-label')->for('model') }}

                    <div class="col-md-10">
                        {{ html()->text()->id('model_field')->class('form-control')->placeholder('Enter model name')->attribute('maxlength', 191)->required() }}
                    </div><!--col-->
                </div><!--form-group-->


                <!-- Moved and unhidden guard_name -->
                <div class="form-group row">
                    {{ html()->label(__('Guard Name'))->class('col-md-2 form-control-label')->for('guard_name') }}

                    <div class="col-md-10">
                        {{ html()->text('guard_name')
                        ->class('form-control')
                        ->placeholder(__('Enter guard name'))
                        ->attribute('maxlength', 191)
                        ->required() }}
                    </div><!--col-->
                </div><!--form-group-->
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                {{ form_cancel(route('admin.permissions.index'), __('buttons.general.cancel')) }}
            </div><!--col-->

            <div class="col text-right">
                {{ form_submit(__('buttons.general.crud.update')) }}
            </div><!--row-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
{{ html()->closeModelForm() }}
@endsection
@push('after-scripts')
<script>
    function updateNameField() {
        const action = $('#action_field').val();
        const model = $('#model_field').val();

        if (action && model) {
            const capitalizedAction = action.charAt(0).toUpperCase() + action.slice(1);
            const capitalizedModel = model.charAt(0).toUpperCase() + model.slice(1);
            $('#name_field').val(`${capitalizedAction}${capitalizedModel}Request`);
        }
    }

    function updateDescriptionField() {
        const action = $('#action_field').val();
        const model = $('#model_field').val();

        if (action && model) {
            let description = '';
            switch (action.toLowerCase()) {
                case 'manage':
                    description = `Manages ${model} permissions and settings`;
                    break;
                case 'store':
                    description = `Stores ${model} data in the system`;
                    break;
                case 'update':
                    description = `Updates existing ${model} information`;
                    break;
                default:
                    description = `${action} ${model} operations`;
            }
            $('#description_field').val(description);
        }
    }

    // jQuery document ready and event handlers
    $(document).ready(function() {
        let nameFieldValue = $("#name_field").val();
        if (nameFieldValue) {
            let processedValue = nameFieldValue
                .replace(/^(Update|Store|Manage)\s*/, '') // Remove leading "Update", "Store", "Manage"
                .replace(/\s*Request$/, '') // Remove trailing "Request"
                .trim();

            $("#model_field").val(processedValue);
        }
        let actionField = $("#action_field");

        if (nameFieldValue) {
            // Match "Update", "Store", or "Manage" at the start of the string
            let match = nameFieldValue.match(/^(Update|Store|Manage)/i);
            if (match) {
                let actionValue = match[0].toLowerCase(); // Convert to lowercase
                actionField.val(actionValue); // Set the value
            }
        }

        $('#action_field').on('change', function() {
            updateNameField();
            updateDescriptionField();
        });

        $('#model_field').on('input', function() {
            updateNameField();
            updateDescriptionField();
        });

        // Initial calls
        updateNameField();
        updateDescriptionField();
    });
</script>
@endpush