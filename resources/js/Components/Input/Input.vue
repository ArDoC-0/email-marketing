<script>

export default {
    props: {
        modelValue: {
            required: true
        },
        label: {
            type: String
        },
        type: {
            type: String,
            default: () => 'text'
        }
    },
    emits: ['update:modelValue'],

    methods: {
        updateField(data) {
            this.$emit('update:modelValue', data)
        }
    }
    
}

</script>

<template>
     <div class="flex-1">
        <label class="mb-2" :for=label>
            {{label}}
        </label>

        <input 
        class="rounded-xl p-2 outline-0 w-full border-gray-300 border-1"
        :value="modelValue" 
        :id="label"
        :type="type"
        :placeholder="label"
        @input="updateField($event.target.value)">
    </div>
</template>