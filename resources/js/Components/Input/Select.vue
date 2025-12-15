<script>
export default {
    props: {
        modelValue: {
            type : Number,
            required: true
        },
        data: {
            type: Object,
            default: {
                id: null,
                title: ''
            }
        },
        isMultiple: {
            type: Boolean,
            default: false
        },
        label: {
            type: String
        }
    }
}

</script>

<template>
    <div>
        <label :for="label">
            {{ label }}
        </label>
        <select :is-multiple="isMultiple" multiple :value="modelValue" :name="label" :id="label" >
            <option v-for="d in data" :value="d.id">
                {{ d.title }}
            </option>
        </select>
    </div>
</template>