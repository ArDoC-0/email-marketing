<script>
import Button from '../../Components/Button/Button.vue';
import Input from '../../Components/Input/Input.vue';
import Select from '../../Components/Input/Select.vue';

export default {
    props: {
        model: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            form: {
                id: null,
                firt_name: null,
                last_name: null,
                email: null,
                form_id: null,
                tag_ids: []
            },
            model: this.model
        }

    },

    created() {
        if (!this.form) {
            return null;
        }
        return {

            id: this.model.subscriber.id,
            firt_name: this.model.subscriber.firt_name,
            last_name: this.model.subscriber.last_name,
            email: this.model.subscriber.email,
            form_id: this.model.subscriber.form_id,
            tag_ids: this.model.subscriber.tags.map(t => t.id)
        }
    },

    methods: {
        submit() {
            if (this.model.subscriber) {
                this.$inertia.put(
                    `subscriber/update/${this.model.subscriber.id}`,
                    this.form
                )
            } else {
                this.$inertia.post(
                    `subscriber/create`,
                    this.form
                )
            }
        }
    }
}
</script>

<template>
    <form action="" method="post">
        <div class="flex w-full gap-2 mb-4">
            <Input v-model="form.firt_name" type="text" label="first_name" />
            <Input v-model="form.last_name" type="text" label="first_name" />
        </div>

        <div class="flex w-full">
            <Input v-model="form.email" type="email" label="first_name" />
        </div>

        <div class="flex w-full gap-2">
            <Select v-model="form.form_id" :data="model.forms" label="forms" />

            <Select v-model="form.tag_ids" :data="model.tags" label="tags" :isMultiple="true" />
        </div>
        <div class="flex gap-4">
            <Button type="submit" :class="'bg-blue-500 text-white'">
                Submit
            </Button>
            <Button :is="button" :class="'text-blue-500 bg-white'">
                Cancel
            </Button>
        </div>
    </form>

</template>