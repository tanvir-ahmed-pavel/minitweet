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
					<b class="pl-3">{{this.likesCount}}</b> Likes
				</div>
			</div>
			<div>
				
				<b v-if="PostId" class="pl-3">{{this.comment}}</b> Comments
			</div>
		</div>
		
		
		
	</div>

</template>

<script>
    export default {
        props: ['PostId', 'likes', 'comments'],
        mounted() {
            this.getlike();
            this.countComments();
            console.log(this.PostId);
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
                axios.get('/like/' + this.PostId)
                    .then(response =>{
                        this.status = response.data;
                        // alert(response.data.name);
                        console.log(response.data)
                    })
            },
            countComments() {
                Event.$on('cmtCreated', () => {
                    this.comment= this.comment+1;
                });
                console.log('No Comment Created');
            },
            likePost() {
                axios.get('/post/like/'+ this.PostId)
                    .then(response => {
                        this.status = !this.status;
                        // this.getlike();
                        console.log(response.data);
                        
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