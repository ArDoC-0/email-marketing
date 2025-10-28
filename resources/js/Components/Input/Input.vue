<script>

export default {
    props: {
        modelValue: {
            type: String,
            required: true
        },
        label: {
            type: String
        },
        type: {
            type: String,
            default: 'text'
        }
    },

    created() {
        const emit = defineEmits('update:modelValue')
    },

    methods: {
        updateField(event, data) {
            emit('update:modelValue', data)
        }
    }
    
}
</script>

<template>
     <div class="flex-1">
        <label class="mb-2" for={{label}}>
            {{label}}
        </label>

        <input 
        class="rounded-2xl p-2 outline-0 w-full"
        value="modelValue" 
        id="{{label}}" 
        type="{{ type }}" 
        placeholder="{{label}}"
        @input="updateField($event.target.value)">
    </div>
</template>