<script>
import PerformanceLine from '../../Components/Broadcast/PerformanceLine.vue';
import Button from '../../Components/Button/Button.vue';

export default {
    props: {
        model: {
            type: Object,
            required: true
        }
    },
    components: {
        PerformanceLine
    }
}

</script>

<template>

    <tr v-for="broadcast in model.broadcasts" class="hover:bg-gray-100">
        <td class="px-6 py-4 hover:cursor-pointer">
            <div class="text-sm text-gray-900">{{ broadcast.subject }}</div>
        </td>

        <td class="px-6 py-4">
            <div class="text-sm text-gray-900">
                {{ broadcast.status }}
            </div>
        </td>

        <td class="px-6 py-4">

            <PerformanceLine 
                v-if="broadcast.status !== 'draft'" 
                :performance="model.performances[broadcast.id]"
            />

            <div v-else class="text-center">
                -
            </div>
        </td>

        <td class="p-4 flex gap-1">
            <Button :class="['text-blue-400', 'border-1 border-blue-400', 'hover:text-white bg-blue-400']">
                Preview
            </Button>

            <Button v-if="broadcast.status === 'draft'" 
            :class="['text-green-300', 
            'border-1 border-green-300', 
            'hover:text-white bg-green-300']">
                Send
            </Button>

            <Button :class="['text-red-400', 
            'border-1 border-red-400 bg-red-200', 
            'hover:text-white bg-blue-400']">
                Delete
            </Button>
        </td>
    </tr>

</template>