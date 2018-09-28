const post = new Vue({
    el: '#comments',
    data: {
        comments: {}
    },
    methods: {
        toggleComment(id) {
            if (this.comments.hasOwnProperty(id)) {
                this.$set(
                    this.comments,
                    id,
                    { isActive: ! this.comments[id].isActive }
                );
                // The code below is not reactive, therefore the frontend
                // does not see the changes
                // this.comments[id].isActive = ! this.comments[id].isActive;
            } else {
                this.$set(this.comments, id, { isActive: true });
                // The code below is not reactive, therefore the frontend
                // does not see the changes
                // this.comments[id] = { isActive: true };
            }
        },
        isCommentActive(id) {
            if (this.hasOwnProperty('comments') && this.comments && this.comments.hasOwnProperty(id)) {
                return this.comments[id].isActive;
            }
            return false;
        }
    }
});
