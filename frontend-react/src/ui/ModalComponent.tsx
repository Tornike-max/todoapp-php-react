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
import { useAddTodo } from "../hooks/useAddTodo";

// brand: "Lexus",
//     year: 2017,
//     car_engine: 5.5,
//     variant: "Car",

const ModalComponent = ({
  isOpen,
  onOpenChange,
}: {
  isOpen: boolean;
  onOpenChange: () => void;
}) => {
  const { register, handleSubmit } = useForm<TodoType>();
  const { mutate, isPending } = useAddTodo();

  const onSubmit: SubmitHandler<TodoType> = (data: TodoType) => {
    if (!data) {
      return;
    }
    mutate({ data });
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
        {(onClose) => (
          <form onSubmit={handleSubmit(onSubmit)}>
            <ModalHeader className="flex flex-col gap-1">
              Modal Title
            </ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                label="Model"
                variant="bordered"
                {...register("model", {
                  required: "This Field Is Required",
                })}
              />
              <Input
                label="Year"
                type="number"
                variant="bordered"
                {...register("year", {
                  required: "This Field Is Required",
                })}
              />
              <Input
                label="Car Engine"
                type="number"
                variant="bordered"
                {...register("car_engine", {
                  required: "This Field Is Required",
                })}
              />
              <Input
                label="Variant"
                type="text"
                variant="bordered"
                {...register("variant", {
                  required: "This Field Is Required",
                })}
              />
            </ModalBody>
            <ModalFooter>
              <Button color="primary" variant="light" onPress={onClose}>
                Close
              </Button>
              <Button
                type="submit"
                className="bg-[#6f4ef2] shadow-lg shadow-indigo-500/20"
              >
                {isPending ? "Loading" : "Add"}
              </Button>
            </ModalFooter>
          </form>
        )}
      </ModalContent>
    </Modal>
  );
};

export default ModalComponent;
