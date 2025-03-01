<template>
    <div class="note-item -edit-ready" v-if="isEdit">
        <p :class="classes"  v-html="itemData.content"></p>
        <div :class="classes" :hidden="true">
            <div  contenteditable="true" style="border: none; outline: none;">
                Начните писать здесь...
            </div>
        </div>
    </div>
    <div class="note-item" v-else>
        <p :class="classes" v-html="itemData.content"></p>
    </div>
</template>

<script>
export default {
    name: 'TextItem',
    data() {
        return {

        };
    },
    props: {
        isEdit: {
            required: false,
            type: Boolean
        },
        itemData: {
            required: true,
            type: Object
        },
        classes: {
            required: false,
            type: String
        }
    },
    methods: {

    },
    computed: {

    },
    watch: {

    },
    mounted() {

    },
};
</script>

<style>

</style>
