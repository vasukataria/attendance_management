<template>
	<div>
<div class="container">
	<div id="members">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="col-md-12">
					<h2>Student data
					</h2>
				</div>
			</div>

			<div class="alert alert-danger text-center" v-if="errorMessage">
				<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-alert"></span> {{ errorMessage }}
			</div>
			
			<div class="alert alert-success text-center" v-if="successMessage">
				<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-ok"></span> {{ successMessage }}
			</div>

			<table class="table table-bordered table-striped">
				<thead>
					<th>Image</th>
					<th>Name</th>
					<th>Roll no.</th>
					<th>email</th>
					<th>Age</th>
					<th>Gender</th>
					<th>Action</th>
				</thead>
				<tbody>
					<tr v-for="video in videos"  v-bind:key="video.id">
						<td><img :src="'data:image.png;base64,' + video.img" alt=""></td>
						<td>{{ video.name }}</td>
						<td>{{ video.rollno }}</td>
						<td>{{ video.email }}</td>
						<td>{{ video.age }}</td>
						<td>{{ video.gender }}</td>
						<td>
							<button class="btn btn-success" @click="showEditModal = true; selectMember(video);"><span class="glyphicon glyphicon-edit"></span> Edit</button> <button class="btn btn-danger" @click="showDeleteModal = true; selectMember(video);"><span class="glyphicon glyphicon-trash"></span> Delete</button>

						</td>
					</tr>
				</tbody>
			</table>
		</div>

<!-- Edit Modal -->
<div class="myModal" v-if="showEditModal">
	<div class="modalContainer">
		<div class="editHeader">
			<span class="headerName">Edit Member</span>
			<button class="closeEditBtn pull-right" @click="showEditModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<div class="form-group">
				<label>Image:</label>
				<input type='file' class="x" v-on:change="clickVideo.img" name="class" />
			</div>
			<div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" v-model="clickVideo.name">
			</div>
            <div class="form-group">
                <label>Roll no:</label>
                <input type="text" class="form-control" v-model="clickVideo.rollno">
            </div>
             <div class="form-group">
                <label>Age:</label>
                <input type="text" class="form-control" v-model="clickVideo.age">
            </div>
             <div class="form-group">
                <label>Gender:</label>
                <input type="text" class="form-control" v-model="clickVideo.gender">
            </div>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" @click="showEditModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-success" @click="showEditModal = false; updateMember();"><span class="glyphicon glyphicon-check"></span> Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Delete Modal -->
<div class="myModal" v-if="showDeleteModal">
	<div class="modalContainer">
		<div class="deleteHeader">
			<span class="headerName">Delete Member</span>
			<button class="closeDelBtn pull-right" @click="showDeleteModal = false">&times;</button>
		</div>
		<div class="modalBody">
			<h5 class="text-center">Are you sure you want to Delete</h5><br>
			<h2 class="text-center"><img :src="'data:image.png;base64,' + clickVideo.img" alt=""><br> {{clickVideo.name}}<br> {{clickVideo.rollno}} <br> {{clickVideo.email}} <br> {{clickVideo.age}} <br> {{clickVideo.gender}}</h2>
		</div>
		<hr>
		<div class="modalFooter">
			<div class="footerBtn pull-right">
				<button class="btn btn-default" @click="showDeleteModal = false"><span class="glyphicon glyphicon-remove"></span> Cancel</button> <button class="btn btn-danger" @click="showDeleteModal = false; deleteMember(); "><span class="glyphicon glyphicon-trash"></span> Yes</button>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</div>

</template>
<script>	
import axios from 'axios'
//import Adminheader from '@/components/Adminheader.vue'
export default{
	name: 'Admin',
	components:{
		//Adminheader
	},
	data(){
		return{
		showAddModal: false,
		showEditModal: false,
		showDeleteModal: false,
		errorMessage: "",
		successMessage: "",
		videos: [],
		newMember: {img: '', name: '', rollno:'', email:'', age:'', gender:''},
		clickVideo: {}
	}
},

	mounted(){
		this.getAllMembers();
	},

	methods:{
		getAllMembers: function(){
			var self = this;
			axios.get('')
				.then(function(response){
					//console.log(response);
					if(response.data.error){
						self.errorMessage = response.data.message;
					}
					else{
						self.videos = response.data;
					}
				});
		},
		updateMember(){
			var self = this;
			var memForm = self.toFormData(self.clickVideo);
			axios.post('', memForm)
				.then(function(response){
					console.log(response);
					self.clickVideo = {};
					if(response.data.error){
						self.errorMessage = response.data.message;
					}
					else{
						self.successMessage = response.data;
						self.getAllMembers();
					}
				});
		},

		deleteMember(){
			var self = this;
			var memForm = self.toFormData(self.clickVideo);
			axios.post('', memForm)
				.then(function(response){
					//console.log(response);
					self.clickVideo = {};
					if(response.data.error){
						self.errorMessage = response.data.message;
					}
					else{
						self.successMessage = response.data;
						self.getAllMembers();
					}
				});
		},

		selectMember(video){
			this.clickVideo = video;
		},

		toFormData: function(obj){
			var form_data = new FormData();
            for(var key in obj){
				form_data.append(key, obj[key]);
			}
			return form_data;
		},

		clearMessage: function(){
			this.errorMessage = '';
			this.successMessage = '';
		},
		

	}
}
</script>
<style>
img{
  max-width:180px;
}

input[type=file]{
padding:10px;
background: white;}


.myModal{
	position:fixed;
	top:0;
	left:0;
	right:0;
	bottom:0;
	background: rgba(0, 0, 0, 0.4);
}

.modalContainer{
	width: 555px;
	background: #FFFFFF;
	margin:auto;
	margin-top:50px;
}

.modalHeader{
	padding:10px;
	background: #008CBA;
	color: #FFFFFF;
	height:50px;
	font-size:20px;
	padding-left:15px;
}

.editHeader{
	padding:10px;
	background: #4CAF50;
	color: #FFFFFF;
	height:50px;
	font-size:20px;
	padding-left:15px;
}

.deleteHeader{
	padding:10px;
	background: #f44336;
	color: #FFFFFF;
	height:50px;
	font-size:20px;
	padding-left:15px;
}

.modalBody{
	padding:40px;
}

.modalFooter{
	height:36px;
}

.footerBtn{
	margin-right:10px;
	margin-top:-9px;
}

.closeBtn{
	background: #008CBA;
	color: #FFFFFF;
	border:none;
}

.closeEditBtn{
	background: #4CAF50;
	color: #FFFFFF;
	border:none;
}

.closeDelBtn{
	background: #f44336;
	color: #FFFFFF;
	border:none;

}
@import'~bootstrap/dist/css/bootstrap.css'
</style>