import { Button, Input, Spinner } from "@nextui-org/react";
import { SubmitHandler, useForm } from "react-hook-form";
import { RegisterType } from "../types/types";
import { Link } from "react-router-dom";
import { useRegister } from "../hooks/useRegister";

const RegisterPage = () => {
  const { register, handleSubmit, getValues, reset } = useForm<RegisterType>();
  const { registerUser, isRegistering } = useRegister();

  const onSubmit: SubmitHandler<RegisterType> = (data) => {
    if (!data) {
      return;
    }
    registerUser(data);
    reset();
  };

  return (
    <div className="w-full flex justify-center items-center">
      <div className="max-w-[800px] w-full m-auto flex justify-center items-center py-10">
        <form
          onSubmit={handleSubmit(onSubmit)}
          className="w-full bg-slate-100 px-4 py-10 flex flex-col gap-4"
        >
          <Input
            type="text"
            label="First Name"
            variant="faded"
            color="primary"
            className="w-full"
            {...register("firstname", {
              required: "This Field Is Required",
            })}
          />
          <Input
            type="text"
            label="Lasst Name"
            variant="faded"
            color="primary"
            className="w-full"
            {...register("lastname", {
              required: "This Field Is Required",
            })}
          />
          <Input
            type="email"
            label="Email"
            variant="faded"
            color="primary"
            className="w-full"
            {...register("email", {
              required: "This Field Is Required",
            })}
          />

          <Input
            type="password"
            label="Password"
            color="primary"
            variant="faded"
            className="w-full"
            {...register("password", {
              required: "This Field Is Required",
            })}
          />
          <Input
            type="password"
            label="Confirm Password"
            color="primary"
            variant="faded"
            className="w-full"
            {...register("confirmPassword", {
              required: "This Field Is Required",
              validate: (value) =>
                value === getValues("password") || "Passwords should match",
            })}
          />
          <div className="w-full flex justify-end items-center px-4 gap-2">
            <Button type="submit" variant="shadow" color="primary">
              {isRegistering ? (
                <Spinner size="sm" color="default" />
              ) : (
                "Register"
              )}
            </Button>
          </div>
          <div className="w-full flex justify-end items-center px-4 gap-2">
            <Link to="/login">Already Registered? Login </Link>
          </div>
        </form>
      </div>
    </div>
  );
};

export default RegisterPage;
