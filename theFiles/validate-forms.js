var theFilesToAdd = document.forms.filesToAdd;


//variable for the errors of add file start here 
var theErrorFileNo = document.getElementById('errorFileNo');
var theErrorPickerName = document.getElementById('errorPickerName');
var theErrorFileUser = document.getElementById('errorFileUser');
var theErrorAddDept = document.getElementById('errorAddDept');

//variable for the errors of add file ends here 




// check for file number in add file
function checkFileNo(){

	if (theFilesToAdd.fileNo.value === "" || theFilesToAdd.fileNo.value === null) {

		theFilesToAdd.fileNo.style.borderColor = "red";
		theErrorFileNo.innerHTML = "Enter a File Number";

	}else if (theFilesToAdd.fileNo.value !== "" && theFilesToAdd.fileNo.value !== null && theFilesToAdd.fileNo.value.length <= 4 ) {

		theFilesToAdd.fileNo.style.borderColor = "red";
		theErrorFileNo.innerHTML = "File Number is incomplete";

	}else{

		theFilesToAdd.fileNo.style.border = "3px solid green";
		theErrorFileNo.innerHTML = "";
	}
}

theFilesToAdd.fileNo.addEventListener("blur", checkFileNo, false);

//check if a picker was selected

function checkPicker(){

	if (theFilesToAdd.filePicker.value == 'noPicker') {

   theFilesToAdd.filePicker.style.borderColor = "red";
    theErrorPickerName.innerHTML = "Select a Picker";

	}else {

		theFilesToAdd.filePicker.style.border = "3px solid green";
		 theErrorPickerName.innerHTML = "";

	}
}

theFilesToAdd.filePicker.addEventListener("blur", checkPicker, false);

// check if  user of file is inputted
function checkFileUser(){

	if (theFilesToAdd.fileUser.value === "" || theFilesToAdd.fileUser.value === null) {

		theFilesToAdd.fileUser.style.borderColor = "red";
		theErrorFileUser.innerHTML = "Enter File User name";

	}else{

		theFilesToAdd.fileUser.style.border = "3px solid green";
		theErrorFileUser.innerHTML = "";

	}
}

    theFilesToAdd.fileUser.addEventListener("blur", checkFileUser, false);

//check if department is selected

function checkDept(){

	if (theFilesToAdd.departmentStore.value == 'noDept') {

		theFilesToAdd.departmentStore.style.borderColor = "red";
		theErrorAddDept.innerHTML = "Select Department";
	}else{

		theFilesToAdd.departmentStore.style.border = "3px solid green";
		theErrorAddDept.innerHTML = "";

	}
}

theFilesToAdd.departmentStore.addEventListener("blur", checkDept, false);

