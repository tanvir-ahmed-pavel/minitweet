<template>
	
	<div>
		<div>
			{{n_comment}}
		</div>
		
				<form action="" @submit.prevent="submit">
					<div class="input-group mb-2 p-4 pt-2 ">
						<div class="mr-2">
							<div class="float-right overflow-hidden d-flex justify-content-center align-items-center position-relative img-wrapper">
								
								<img v-if="UserImg" :src="'/storage/' + UserImg" alt="img"
								     class="img">
								<i v-if="!UserImg" class="fas fa-user-ninja"></i>
								<div class="d-flex justify-content-center align-items-center position-absolute img-border">
								</div>
							</div>
						</div>
						<input type="text" class="form-control border-0 input"
						       placeholder="Add a Comment..." v-model="comment">
						<div class="input-group-append pl-2">
							<button class="btn button"
							        :class="comment ? 'btn-outline-primary' : 'btn-outline-secondary'"
							        :disabled="!comment" type="submit">
								<i class="far fa-paper-plane fa-1x"></i>
							</button>
							<input type="hidden" :value="csrf" name="_token" id="csrf-token">
						</div>
						<span class="invalid-feedback" role="alert">
					<strong></strong>
				</span>
					</div>
				</form>
		
		<!--		<button @click="followUser" class="btn pl-2 pr-2 ml-4 mb-1 p-0"-->
		<!--		        :class="status ? 'btn-outline-secondary' : 'btn-primary'" v-text="buttonText"></button>-->
	</div>

</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted.');
        },
        props: ['csrf', 'PostId', 'UserImg'],


        data() {
            return {
                comment: '',
                n_comment: '',
            }
        },
        methods: {
            submit() {
                axios.post('/post/' + this.PostId + '/comment', {comment: this.comment})
                    .then(response => {
                        this.n_comment = this.comment;
                        this.comment = '';
                        Event.$emit('cmtCreated');
                        console.log(response.data)
                    })
            }
        }
    }
</script>
<style scoped>
	.button {
		border: none;
		border-radius: 15px !important;
		background-color: rgba(0, 0, 0, 0.09);
	}
	
	.button:hover {
		background-color: rgb(34, 156, 241)
	}
	
	.button:disabled {
		background-color: rgba(0, 0, 0, 0.09);
	}
	
	.input {
		height: 40px;
		background-color: rgba(0, 0, 0, 0.07) !important;
		border-radius: 20px !important;
	}
	
	.img {
		height: 100% !important;
		width: auto !important;
	}
	
	.img-wrapper {
		height: 38px;
		width: 38px;
		border: 1.5px solid rgba(0, 0, 0, 0.77);
		border-radius: 50%;
		background-color: rgba(255, 255, 0, 0)
	}
	
	.img-border {
		height: 35px;
		width: 35px;
		border: 2px solid #ffffff;
		border-radius: 50%;
	}


</style>
