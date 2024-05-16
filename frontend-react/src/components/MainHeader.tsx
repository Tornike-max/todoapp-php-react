import { Button, useDisclosure } from "@nextui-org/react";
import ModalComponent from "../ui/ModalComponent";

const MainHeader = () => {
  const { isOpen, onOpen, onOpenChange, onClose } = useDisclosure();
  return (
    <>
      <div className="w-full flex justify-center items-center bg-slate-200 rounded-2xl">
        <Button onPress={onOpen} variant="bordered" color="primary" size="lg">
          Add A Task
        </Button>
      </div>
      {isOpen && (
        <ModalComponent
          isOpen={isOpen}
          onOpenChange={onOpenChange}
          onClose={onClose}
        />
      )}
    </>
  );
};

export default MainHeader;
