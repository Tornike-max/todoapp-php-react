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

export const getTodos = async () => {
  try {
    const response = await axios.get("http://localhost:8080/gettodos");
    if (!response.data) {
      throw new Error(`An error occurred: ${response.status}`);
    }

    const todos = response.data;

    return todos;
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

export const getSingleTodo = async (todoId: string) => {
  try {
    const response = await axios.get(
      `http://localhost:8080/gettodo?id=${todoId}`
    );

    if (!response.data) {
      throw new Error(`An error occurred: ${response.status}`);
    }
    const todo = response.data;

    return todo[0];
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

export const updateTodo = async (todoId: string, data: TodoType) => {
  try {
    const response = await axios.post(
      `http://localhost:8080/update?id=${todoId}`,
      data
    );

    if (!response.data) {
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
