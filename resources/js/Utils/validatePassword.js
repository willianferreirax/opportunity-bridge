export default function validatePassword(password) {
    // Check for minimum length
    if (password.length < 8) {
      return false;
    }
  
    // Check for at least one letter, one digit, and one special character
    const hasLetter = /[a-zA-Z]/.test(password);
    const hasDigit = /\d/.test(password);
    const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(password);
  
    return hasLetter && hasDigit && hasSpecial;
}