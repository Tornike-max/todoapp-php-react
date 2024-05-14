import axios from "axios";
import { TodoType } from "../types/types";

export const addTodo = async ({ data }: { data: TodoType }) => {
  try {
    const response = await axios.post("http://localhost:8080/addtodo", data);
    if (response.status !== 200) {
      throw new Error(`An error occurred: ${response.status}`);
    }
    return response.data;
  } catch (error) {
    if (axios.isAxiosError(error)) {
      throw new Error(
        error.response?.data.message || "An axios error occurred"
      );
    } else {
      throw new Error("An unexpected error occurred");
    }
  }
};
