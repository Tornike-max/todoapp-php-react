import { Button, Input, Spinner } from "@nextui-org/react";
import { SubmitHandler, useForm } from "react-hook-form";
import { LoginType } from "../types/types";
import { Link } from "react-router-dom";
import { useLogin } from "../hooks/useLogin";

const LoginPage = () => {
  const { register, handleSubmit } = useForm<LoginType>();
  const { loginUser, isLogingIn } = useLogin();

  const onSubmit: SubmitHandler<LoginType> = (data) => {
    if (!data) {
      return;
    }
    loginUser(data);
  };
  return (
    <div className="w-full flex justify-center items-center">
      <div className="max-w-[800px] w-full m-auto flex justify-center items-center py-10">
        <form
          onSubmit={handleSubmit(onSubmit)}
          className="w-full bg-slate-100 px-4 py-10 flex flex-col gap-4"
        >
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
          <div className="w-full flex justify-end items-center px-4 gap-2">
            <Button type="submit" variant="shadow" color="primary">
              {isLogingIn ? <Spinner size="sm" color="default" /> : "Login"}
            </Button>
          </div>
          <div className="w-full flex justify-end items-center px-4 gap-2">
            <Link to="/register">You don't Have an account? </Link>
          </div>
        </form>
      </div>
    </div>
  );
};

export default LoginPage;
