<template>
	
	<div>
		<div v-for="comment in comments">
				{{comment.comment}}
		</div>
		
	</div>

</template>

<script>
    export default {
        data() {
            return {
                comments: [],
            }
        },
        props: ['PostId'],
        methods: {
            showComment() {

                axios.post('/post/comment/' + this.PostId)
                    .then(response => {
                        this.comments = response.data;
                        // console.log(response.data);

                    });
            }
        },
        mounted() {
            this.showComment();
        },
    }
</script>