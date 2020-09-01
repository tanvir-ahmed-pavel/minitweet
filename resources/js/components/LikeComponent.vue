<template>
	
	<div>
		<button @click="likePost" class="button ">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="" :class="status ? 'btn-red' : 'btn-grey'" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
			</svg>
		</button>
		<div>{{status}}</div>
		
	</div>

</template>

<script>
    export default {
        
        props: ['PostId', 'like'],
        data: function () {
            return {
                status: this.like,
            }
        },
        methods: {
            likePost() {
                axios.get('/post/like/'+ this.PostId)
                    .then(response => {
                        // this.status = !this.status;

                        console.log(response.data)
                    })
                    .catch(errors => {
                        if (errors.response.status === 401) {
                            window.location = '/login';
                        }
                    })

            },
            getlike(){
                axios.post('/like/' + this.PostId)
                    .then(response =>{
                        this.status = response.data;
                       // alert(response.data.name);
	                    console.log(response)
                    })
            },
            mounted() {
                this.getlike();
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