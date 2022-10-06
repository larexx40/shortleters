const iconEyes = document.querySelectorAll(".password-form .form-input em");
const allInc = document.querySelectorAll(".dropdown-item .amount .increase");
const allDec = document.querySelectorAll(".dropdown-item .amount .decrease");
const allInput = document.querySelectorAll(
	".dropdown-item .amount .form-control"
);

// each password triggering passwords alternating to text
iconEyes.forEach((iconEye) => {
	iconEye.onclick = () => {
		const attr = iconEye.previousElementSibling;
		if (attr.type === "password") {
			attr.type = "text";
			iconEye.classList.remove("bi-eye");
			iconEye.classList.add("bi-eye-slash");
		} else {
			attr.type = "password";
			iconEye.classList.add("bi-eye");
			iconEye.classList.remove("bi-eye-slash");
		}
	};
});

console.log(allInput);

allInput.forEach((input) => {
	input.previousElementSibling.onclick = (event) => {
		event.preventDefault();
		event.stopPropagation();
		if (input.value < 1) {
			input.value.innerHTML = "0";
		} else {
			input.value--;
		}
	};
	input.nextElementSibling.onclick = (event) => {
		event.preventDefault();
		event.stopPropagation();
		input.value++;
	};
});
