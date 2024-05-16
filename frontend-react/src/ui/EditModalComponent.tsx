import { Button } from "@nextui-org/button";
import {
  Modal,
  ModalContent,
  ModalHeader,
  ModalBody,
  ModalFooter,
  Input,
} from "@nextui-org/react";
import { SubmitHandler, useForm } from "react-hook-form";
import { TodoType } from "../types/types";
import { useGetTodo } from "../hooks/useGetTodo";
import { useUpdateTodo } from "../hooks/useUpdateTodo";

const EditModalComponent = ({
  isOpen,
  onOpenChange,
  onClose,
  todoId,
}: {
  isOpen: boolean;
  onOpenChange: () => void;
  onClose: () => void;
  todoId?: string;
}) => {
  const { register, handleSubmit } = useForm<TodoType>();
  const { todoData, isTodoPending } = useGetTodo(todoId || "");
  const { udpate, isUpdating } = useUpdateTodo();

  if (isTodoPending) return <p>Loading...</p>;

  const onSubmit: SubmitHandler<TodoType> = (data: TodoType) => {
    if (!todoId || !data) {
      return;
    }

    udpate({ id: todoId, data: data });
    onClose();
  };

  return (
    <Modal
      backdrop="opaque"
      isOpen={isOpen}
      onOpenChange={onOpenChange}
      radius="lg"
      classNames={{
        body: "py-6",
        backdrop: "bg-[#292f46]/50 backdrop-opacity-40",
        base: "border-[#292f46] bg-[#19172c] dark:bg-[#19172c] text-[#a8b0d3]",
        header: "border-b-[1px] border-[#292f46]",
        footer: "border-t-[1px] border-[#292f46]",
        closeButton: "hover:bg-white/5 active:bg-white/10",
      }}
    >
      <ModalContent>
        <form onSubmit={handleSubmit(onSubmit)}>
          <ModalHeader className="flex flex-col gap-1">Modal Title</ModalHeader>
          <ModalBody>
            <Input
              autoFocus
              label="Model"
              variant="bordered"
              defaultValue={todoData.model}
              {...register("model", {
                required: "This Field Is Required",
              })}
            />
            <Input
              label="Year"
              type="number"
              variant="bordered"
              defaultValue={todoData.year}
              {...register("year", {
                required: "This Field Is Required",
              })}
            />
            <Input
              label="Car Engine"
              type="number"
              variant="bordered"
              defaultValue={todoData.car_engine}
              {...register("car_engine", {
                required: "This Field Is Required",
              })}
            />
            <Input
              label="Variant"
              type="text"
              variant="bordered"
              defaultValue={todoData.variant}
              {...register("variant", {
                required: "This Field Is Required",
              })}
            />
          </ModalBody>
          <ModalFooter>
            <Button color="primary" variant="light">
              Close
            </Button>
            <Button
              type="submit"
              className="bg-[#6f4ef2] shadow-lg shadow-indigo-500/20"
            >
              {isUpdating ? "Loading..." : "Edit"}
            </Button>
          </ModalFooter>
        </form>
      </ModalContent>
    </Modal>
  );
};

export default EditModalComponent;
