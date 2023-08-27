export default function validatePhone(phone) {
    //remove mask
    phone = phone.replace(/\D/g, '');

    //check if is empty
    if (phone === '') {
        return false;
    }

    //check if is valid
    if (phone.length < 10 || phone.length > 11) {
        return false;
    }

    return true;
}