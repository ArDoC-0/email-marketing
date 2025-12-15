<script>
import Button from '../../Components/Button/Button.vue';
import Dropdowncontainer from '../../Components/Input/Dropdowncontainer.vue';
import Dropdowns from '../../Components/Input/Dropdowns.vue';
import Input from '../../Components/Input/Input.vue';
import Select from '../../Components/Input/Select.vue';

export default {
    components: {
        Button,
        Input,
        Select,
        Dropdowns,
        Dropdowncontainer
    },
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
        }

    },

    created() {
        console.log(this.form.tag_ids);
        if (!this.model.subscriber) {
            return null;
        }

        this.form = {
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
            console.log(this.form);
            if (this.model.subscriber) {
                this.$inertia.put(
                    `/subscriber/${this.model.subscriber.id}`,

                    this.form

                )
            } else {object
                this.$inertia.post(
                    `/subscriber`,
                    this.form
                )
            }
        }
    }
}
</script>

<template>
    <div class="flex flex-col justify-center items-center rounded-2xl shadow-2xl py-4 px-4">
        <h2 class="text-center text-2xl text-shadow-gray-700">
            Create subscriber
        </h2>
        <form @submit.prevent="submit" class=" p-4" action="" method="post">
            <div class="flex w-full gap-2 mb-4">
                <Input v-model="form.firt_name" type="text" label="first_name" />
                <Input v-model="form.last_name" type="text" label="first_name" />
            </div>

            <div class="flex w-full">
                <Input v-model="form.email" type="email" label="email" />
            </div>

            <div class="flex flex-wrap justify-center w-full mb-4 gap-4">
                <div class="flex-1">
                        <Dropdowns v-model="form.form" :data="model.forms" :isMultiple ="false" :label="'Forms'" />
                </div>
                 <div class="flex-1">

                        <Dropdowns v-model="form.tag_ids"  :data="model.tags" :isMultiple ="true" :label="'Tags'" />
                </div>

            </div>
            <div class="flex gap-4">
                <Button type="submit" :class="'bg-blue-500 text-white'">
                    Submit
                </Button>
                <Button :class="'text-blue-500 bg-white'">
                    Cancel
                </Button>
            </div>
        </form>
    </div>

</template>