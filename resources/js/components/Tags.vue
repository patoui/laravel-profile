<template>
<div class="field">
    <label class="label">Tags</label>
    <div class="field has-addons">
        <div class="control">
            <input v-model="name" class="input" type="text" placeholder="Tag name...">
        </div>
        <div class="control">
            <a @click="add" class="button">Add</a>
        </div>
    </div>

    <p class="tags">
        <span class="button is-small" style="margin-right: 5px;" v-for="tag in tags">{{ '#' + tag }}</span>
    </p>

    <input type="hidden" name="tags[]" v-for="tag in tags" v-bind:value="tag">

    <p v-if="errors.has('tags')" class="help is-danger">{{ errors.first('tags') }}</p>
</div>
</template>

<script>
    import Errors from '../classes/Errors';

    export default {
        props: ['initialTags', 'initialErrors'],

        data() {
            return {
                errors: new Errors(),
                name: '',
                tags: []
            };
        },

        mounted() {
            this.tags = this.initialTags;
            this.errors = new Errors(this.initialErrors);
        },

        methods: {
            add() {
                this.tags.push(this.name);
                this.name = '';
            }
        }
    }
</script>
