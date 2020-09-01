<template>
	
	<div>
		<button @click="followUser" class="btn pl-2 pr-2 ml-4 mb-1 p-0" :class="status ? 'btn-outline-secondary' : 'btn-primary'" v-text="buttonText"></button>
	</div>
	
</template>

<script>
	export default {
	    mounted(){
	        console.log('Component mounted.')
	    },
		props: ['UserId', 'follows'],
		data: function(){
	        return{
                status: this.follows,
	        }
		},
		methods: {
	        followUser(){
	            axios.post('/follow/' + this.UserId)
                .then(response => {
                    this.status = ! this.status;
                    
                    console.log(response.data)
                })
		            .catch(errors => {
		                if(errors.response.status === 401){
		                    window.location = '/login';
		                }
		            })
		            
	        }
		},
		computed: {
	        buttonText(){
	            return (this.status) ? 'Unfollow' : 'Follow';
	        }
		}
	}
</script>