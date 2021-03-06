const mongoose = require('mongoose');
const bcrypt = require('bcryptjs');

// Creating Student Schema
const StudentSchema = new mongoose.Schema({
	name: {
		type: String,
		required: true
	},
	enrollment_no: {
		type: Number,
		required: true,
		unique: true,
		index: true
	},
	cgpa: {
		type: Number,
		required: true,
		min:4,
		max:10
	},
	email_address: {
		type: String,
		required: true
	},
	password: {
		type: String,
		required: true
	},
	jobs_applied: {
		type: [mongoose.Schema.Types.ObjectId],
		required: false
	},
	user_type: {
		type: String,
		default: 'student'
	}
});

const Student = module.exports = mongoose.model('Student', StudentSchema);

module.exports.getStudentById = function(id, callback){
	Student.findById(id, callback);
}

module.exports.getStudentByEnrollment_no = function(enrollment_no, callback){
	const query = {enrollment_no: enrollment_no};
	Student.findOne(query, callback);
}

module.exports.addStudent = function(newStudent, callback){
	bcrypt.genSalt(10, function(err, salt){
		bcrypt.hash(newStudent.password, salt, function(err, hash){
			if(err) throw err;
			newStudent.password = hash;
			newStudent.save(callback);
		});
	});
}

module.exports.comparePassword = function(candidatePassword, hash, callback){

	bcrypt.compare(candidatePassword, hash, function(err, isMatch){
		// console.log((isMatch? 'in compare match': 'in compare password no match'));
		try{
			callback(null, isMatch);
		}catch(err){
			console.log('login failed');
			throw err;
		}
	});
}

module.exports.applyForJob = function(job_id, student_id, callback){
	Student.findByIdAndUpdate(
		student_id,
		{$push: {'jobs_applied': job_id}},
		{safe: true, upsert: false, new: true},
		callback
	);
}

//
// module.exports.updateProfile = function()
