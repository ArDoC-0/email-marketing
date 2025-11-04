<script>
import Button from '../../Components/Button/Button.vue';
import Dropdowns from '../../Components/Input/Dropdowns.vue';
import Input from '../../Components/Input/Input.vue';

export default {
    components: {
        Input,
        Dropdowns,
        Button
    },

    props: {
        model: {
            type: Object
        }
    },

    data() {
       return {
        form : {
            id: null,
            subject: null,
            content: null,
            form_ids: [],
            tag_ids: []
        },
        forms: this.model.forms,
        tags: this.model.tags
    }
    },

    created(){
        console.log(this.model);
        if(!this.model.broadcast)
        {
            return
        }
        this.form = {
            id: this.model.broadcast.id,
            subject: this.model.broadcast.subject,
            content: this.model.broadcast.content,
            form_ids: this.model.broadcast.filters.form_id,
            tag_ids: this.model.broadcast.filters.tag_ids
        }
    },

    methods: {
        submit(){

            if(!this.model.broadcast) {
                this.$inertia.post('/subscriber', this.form)

            }else {
                this.$inertia.put('/subscriber', this.form)

            }
        }
    }
}


</script>

<template>
    <div class="p-4 w-full bg-gray-50">

        <div class="m-auto w-[60%] p-4 rounded-2xl shadow-xl">
            <form @submit.prevent="submit" class="flex flex-wrap">
                <Input :label="'subject'" :class="['mb-4']" v-model="form.subject" />
            </form>

            <label class="mb-2" for="">
                Content
            </label>

            <textarea v-model="form.content" class="bg-gray-100 w-full h-[10rem] rounded-2xl p-4" :placeholder="'HTML Content'">

            </textarea>

            <h5 class="text-md mt-4">Filters</h5>

            <div class="flex gap-4 mb-4">

                <div class="flex-1">
                    <Dropdowns
                    :is-multiple="true"
                    v-model="form.form_ids"
                    :data="model.forms"
                    label="Forms"
                    />
                </div>

                <div class="flex-1">
                    
                    <Dropdowns
                    :is-multiple="true"
                    v-model="form.tag_ids"
                    :data="model.tags"
                    :label="'Tags'"
                    />
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
        </div>

    </div>
</template>