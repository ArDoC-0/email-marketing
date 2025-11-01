<script>
import Dropdowncontainer from './Dropdowncontainer.vue';

export default {
    components: {
        Dropdowncontainer
    },
    props: {
        isMultiple: {
            type: Boolean,
            default: false
        },
        modelValue: {
            type: [Number, Array],
            required: false
        },
        data: {
            type: Object,
            default: () => ({
                id: null,
                title: ''
            })
        },
        label: String

    },
    emits: ['update:modelValue'],
    methods: {
        handleUpdate(data) {
            this.$emit('update:modelValue', data)
        },

        isSelected (option) {
            return Array.isArray(this.modelValue) && this.modelValue.includes(option);
        },

        toggleOption(option) {
            let updated = Array.isArray(this.modelValue) ? [...this.modelValue] : []

            if (updated.includes(option)) {
                updated = updated.filter(item => item !== option)
            } else {
                updated.push(option)
            }

            this.handleUpdate(updated)
        }
    }
}

</script>

<template>
    <h5 class="mb-2 mt-4">
        {{ label }}
    </h5>
    <Dropdowncontainer>
        <label v-for="d in data"
        class="flex flex-1 items-center gap-2 p-2 rounded-lg bg-gray-100 hover:bg-gray-200 cursor-pointer transition">
            <input v-if="isMultiple" 
            :value="d.id" 
            class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"
            type="checkbox" 
            @change="toggleOption(d.id)" 
            :checked="isSelected(d.id)"/>

            <input :name="label" :checked="d.id === modelValue" v-if="!isMultiple" :value="d.id"
                class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500" type="radio"
                @change="handleUpdate(d.id)" />
            <span class="text-gray-700">{{ d.title }}</span>
        </label>
    </Dropdowncontainer>
</template>false