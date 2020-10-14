<template>
	
	<div>
		<div class="d-flex align-items-center justify-content-between">
			<div class="d-flex align-items-center">
				<div>
					<button @click="likePost" class="button ">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="" :class="status ? 'btn-red' : 'btn-grey'" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
						</svg>
					</button>
				</div>
				<div>
					
					<!-- Button trigger modal -->
					<a href="#" type="button" class="text-decoration-none text-dark" data-toggle="modal" :data-target="DataTarget">
						<b class="pl-3">{{this.likesCount}}</b> Likes
					</a>
					
					
				</div>
			</div>
			<div>
				<a :href="'/post/' + PostId" class="text-decoration-none text-muted">
				<b v-if="PostId" class="pl-3">{{this.comment}}</b> Comments
				</a>
			</div>
		</div>
		
		
		
	</div>

</template>

<script>
    export default {
        
        props: ['PostId', 'likes', 'comments', 'DataTarget'],
        mounted() {
            this.getlike();
            this.countComments();
            Event.$on('cmtCreated', () => {
                this.countComments();
            });
            Event.$on('cmtDeleted', () => {
                this.countComments();
            });
        },
        data: function () {
            return {
                status: '',
	            likesCount: Number(this.likes),
                comment: Number(this.comments),
            }
        },
        
        methods: {
            getlike(){
                axios.post('/like/' + this.PostId)
                    .then(response =>{
                        this.status = response.data;
                    })
            },
            countComments() {
                axios.post('/post/comment/' + this.PostId)
	                    .then(response => {
                            this.comment= response.data.commentsCount;
	                    })
                
            },
            likePost() {
                axios.post('/post/like/'+ this.PostId)
                    .then(response => {
                        this.status = !this.status;
                        
                        // Getting Likes Count
                        if (this.status === true){
	                        this.likesCount = this.likesCount+1;
                        } else{
                            this.likesCount = this.likesCount - 1;
                        }
                        
                    })
                    .catch(errors => {
                        if (errors.response.status === 401) {
                            window.location = '/login';
                        }
                    })
            },
            
        },
    }
</script>
<style scoped>
	.button {
		display: inline-block;
		border: none;
		padding: 0;
		margin: 0;
		text-decoration: none;
		background: none;
		color: #ffffff;
		font-family: sans-serif;
		font-size: 1.5rem;
		line-height: 1;
		cursor: pointer;
		text-align: center;
		transition: background 250ms ease-in-out, transform 150ms ease;
		-webkit-appearance: none;
		-moz-appearance: none;
	}
	
	.button:hover,
	.button:focus {
		background: none;
	}
	
	.button:focus {
		outline: 0;
		outline-offset: -4px;
	}
	
	.button:active {
		transform: scale(1.2);
	}
	.btn-grey{
		color: #6c6c6c;
	}
	.btn-red{
		color: #ff4148;
	}
</style>