export const email = (email) => {
  let regexp =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regexp.test(String(email).toLowerCase());
};
export const required = (field) => {
  return (
    field !== undefined &&
    field !== null &&
    field !== "" &&
    field !== [] &&
    field !== false
  );
};
export const same = (val1, val2) => {
  return val1 === val2;
};
