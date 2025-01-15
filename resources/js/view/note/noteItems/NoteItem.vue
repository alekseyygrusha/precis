<template>
    <div class="note-item">
        <component :is="componentName"></component>
    </div>
</template>

<script>
import HeadingItem from "@/view/note/noteItems/HeadingItem.vue";
export default {
    name: 'NoteItem',
    data() {
        return {

        };
    },
    components: {
        HeadingItem
    },
    props: {
        itemData: {
            required: true,
            type: Object
        }
    },
    methods: {

    },
    computed: {
        componentName() {
            return `${this.itemData.type.charAt(0).toUpperCase() + this.itemData.type.slice(1)}Item`
        },

    },
    watch: {

    },
    mounted() {

    },
};
</script>

<style>

</style>
